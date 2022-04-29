window.onload=()=>{
iniciarApp()
}

const iniciarApp=()=>{
mostrarNavegacion()
modoOscuro()
}

const mostrarNavegacion=()=>{
  const burguer = document.querySelector(".barra__burguer")
  const navegacion = document.querySelector(".nav")
  burguer.onclick=()=>{
navegacion.classList.toggle("ocultar")
  }
}

const modoOscuro=()=>{
const botonOscuro = document.querySelector(".dark-mode")
botonOscuro.onclick=()=>{
  document.body.classList.toggle("oscuro")
}
//ver preferencias dark
const darkMode = window.matchMedia('(prefers-color-scheme: dark)').matches
if(darkMode){
document.body.classList.add("oscuro")
}else{
  document.body.classList.remove("oscuro")
}

darkMode.onchange=()=>{
  if(darkMode){
    document.body.classList.add("oscuro")
    }else{
      document.body.classList.remove("oscuro")
    }
}

}