;(() => {
  document.addEventListener("DOMContentLoaded", () => {
    console.log("[v0] DOM cargado")

    if (typeof window.$ === "undefined") {
      console.error("[v0] jQuery no está disponible")
      return
    }

    const $ = window.$
    console.log("[v0] jQuery disponible")

    const csrfToken = $('meta[name="csrf-token"]').attr("content")
    if (!csrfToken) {
      console.error("[v0] Token CSRF no encontrado")
      return
    }
    console.log("[v0] Token CSRF encontrado")

    $.ajaxSetup({
      headers: {
        "X-CSRF-TOKEN": csrfToken,
      },
    })

    // Manejar clic en badges de estado
    $(document).on("click", '.badge[style*="cursor: pointer"]', function (e) {
      e.preventDefault()
      console.log("[v0] Clic en badge detectado")

      const $badge = $(this)
      const $checkbox = $badge.siblings(".toggle-class")

      if ($checkbox.length === 0) {
        console.error("[v0] No se encontró el checkbox asociado")
        return
      }

      const elementType = $checkbox.data("type")
      const elementId = $checkbox.data("id")
      const currentState = $checkbox.prop("checked")

      console.log("[v0] Datos del elemento:", {
        tipo: elementType,
        id: elementId,
        estadoActual: currentState,
      })

      // Determinar la URL según el tipo
      let url
        switch (elementType) {

          case "conductores": 
            url = "/conductores/" + elementId + "/cambio-estado"
            break
          case "contratos":
            url = "/contratos/" + elementId + "/cambio-estado"
            break
          case "empresas":
            url = "/empresas/" + elementId + "/cambio-estado"
            break
          case "licencias":
            url = "/licencias/" + elementId + "/cambio-estado"
            break
          case "marcas":
            url = "/marcas/" + elementId + "/cambio-estado"
            break
          case "recarga_combustibles":
            url = "/recarga_combustibles/" + elementId + "/cambio-estado"
            break
          case "rutas":
            url = "/rutas/" + elementId + "/cambio-estado"
            break
          case "tipo_vehiculos":  
            url = "/tipo_vehiculos/" + elementId + "/cambio-estado"
            break
          case "vehiculos":
            url = "/vehiculos/" + elementId + "/cambio-estado"
            break
          case "viajes":
            url = "/viajes/" + elementId + "/cambio-estado"
            break
          default:
            console.error("[v0] Tipo de elemento no válido:", elementType)
            return
        }


      console.log("[v0] URL de petición:", url)

      // Deshabilitar el badge temporalmente
      $badge.css("pointer-events", "none").css("opacity", "0.6")

      // Realizar petición AJAX
      $.ajax({
        type: "POST",
        url: url,
        dataType: "json",
        success: (response) => {
          console.log("[v0] Respuesta exitosa:", response)

          // Actualizar el checkbox
          $checkbox.prop("checked", response.nuevo_estado)

          // Actualizar el badge visualmente
          if (response.nuevo_estado) {
            $badge.removeClass("badge-danger").addClass("badge-success")
            $badge.html('<i class="fas fa-check-circle mr-1"></i> Activo')
          } else {
            $badge.removeClass("badge-success").addClass("badge-danger")
            $badge.html('<i class="fas fa-times-circle mr-1"></i> Inactivo')
          }

          // Agregar animación de éxito
          $badge.addClass("pulse-animation")
          setTimeout(() => {
            $badge.removeClass("pulse-animation")
          }, 600)

          console.log("[v0] Estado actualizado correctamente")
        },
        error: (xhr, status, error) => {
          console.error("[v0] Error en la petición:", {
            status: status,
            error: error,
            response: xhr.responseText,
          })

          alert("Error al cambiar el estado. Por favor, revise la consola para más detalles.")
        },
        complete: () => {
          // Rehabilitar el badge
          $badge.css("pointer-events", "auto").css("opacity", "1")
        },
      })
    })

    console.log("[v0] Script de cambio de estado inicializado correctamente")
  })
})()