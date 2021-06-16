let livro_id = $("input[name*='livro_id']")
livro_id.attr("readonly","readonly");


$(".btnedit").click( e =>{
    let textvalues = displayData(e);

    ;
    let titulo_livro = $("input[name*='titulo_livro']");
    let editora = $("input[name*='editora']");
    let preco = $("input[name*='preco']");

    livro_id.val(textvalues[0]);
    titulo_livro.val(textvalues[1]);
    editora.val(textvalues[2]);
    preco.val(textvalues[3].replace("$", ""));
});


function displayData(e) {
    let id = 0;
    const td = $("#tbody tr td");
    let textvalues = [];

    for (const value of td){
        if(value.dataset.id == e.target.dataset.id){
           textvalues[id++] = value.textContent;
        }
    }
    return textvalues;

}