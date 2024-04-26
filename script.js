document.addEventListener('DOMContentLoaded', function () {
  var orderForm = document.getElementById('orderForm')
  if (orderForm) {
    orderForm.addEventListener('submit', function (event) {
      event.preventDefault()

      var nameInput = document.getElementById('name')
      var phoneInput = document.getElementById('phone')
      var name = nameInput.value
      var phone = phoneInput.value

      var xhr = new XMLHttpRequest()
      xhr.open('POST', 'https://order.drcash.sh/v1/order', true)
      xhr.setRequestHeader('Content-Type', 'application/json')
      xhr.setRequestHeader('Authorization', 'Bearer RLPUUOQAMIKSAB2PSGUECA')
      xhr.onreadystatechange = function () {
        if (xhr.readyState === 4) {
          if (xhr.status === 200) {
            window.location.href = 'thank_you.html'
          } else {
            console.error('Ошибка при отправке данных:', xhr.responseText)
          }
        }
      }
      var data = JSON.stringify({
        stream_code: 'vv4uf',
        client: {
          phone: phone,
          name: name,
        },
      })
      xhr.send(data)
    })
  }
})
