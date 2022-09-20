let btnExcluir = document.querySelectorAll(".excluir");
let excluirItem = document.querySelector("#excluirCadastro");

for(let elementos of btnExcluir){
  console.log(elementos)

  elementos.addEventListener("click", ()=>{
    // console.log(elementos.getAttribute("id"))
    excluirItem.value = elementos.getAttribute("id")
  })
}