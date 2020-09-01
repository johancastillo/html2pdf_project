/*
Campos a validar
*/

let inputCredito = document.getElementById('credito'),
    credito = 0,
    inputIntereses = document.getElementById('intereses'),
    intereses = 0

/*
Botones
*/
let btnCalcular = document.getElementById('btn-calcular')

/*
Validaciones
*/
inputCredito.addEventListener('keyup', () => {
  credito = inputCredito.value
})

inputIntereses.addEventListener('keyup', () => {
  intereses = inputIntereses.value
})


btnCalcular.addEventListener('click', () => {
  if(credito == 0 && intereses == 0){
    Swal.fire({
      icon: 'error',
      title: 'Oops...',
      text: 'Hay campos vacíos en el formulario',
      footer: '<a href>Why do I have this issue?</a>'
    })
  }else if(credito == 0){
    Swal.fire({
      icon: 'error',
      title: 'Oops...',
      text: 'Something went wrong!',
      footer: '<a href>Why do I have this issue?</a>'
    })
  }else if(intereses == 0){
    Swal.fire({
      icon: 'error',
      title: 'Oops...',
      text: 'Something went wrong!',
      footer: '<a href>Why do I have this issue?</a>'
    })
  }else{
    Swal.fire({
  position: 'top-end',
  icon: 'success',
  title: 'Los calculos se han realizado correctamente',
  showConfirmButton: false,
  timer: 1500
})
  }

})
