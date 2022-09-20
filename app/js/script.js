let btnExcluir = document.querySelectorAll(".excluir");
let excluirItem = document.querySelector("#excluirCadastro");

for(let elementos of btnExcluir){
  console.log(elementos.getAttribute("id"))

  

  elementos.addEventListener("click", ()=>{
    
    excluirItem.value = elementos.getAttribute("id")
  })
}