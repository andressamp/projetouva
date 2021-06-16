<?php

require_once ("db.php");
require_once ("component.php");

$con = Createdb();

if(isset($_POST['create'])){
    createData();
}

if(isset($_POST['update'])){
    UpdateData();
}

if(isset($_POST['delete'])){
    deleteRecord();
}

if(isset($_POST['deleteall'])){
    deleteAll();

}

function createData(){
    $titulo_livro = textboxValue("titulo_livro");
    $editora = textboxValue("editora");
    $preco = textboxValue("preco");

    if($titulo_livro && $editora && $preco){

        $sql = "INSERT INTO Livro (titulo_livro, editora, preco) 
                        VALUES ('$titulo_livro','$editora','$preco')";

        if(mysqli_query($GLOBALS['con'], $sql)){
            TextNode("success", "Registro inserido com sucesso...!");
        }else{
            echo "Error";
        }

    }else{
            TextNode("error", "Preencha o dado na caixa de texto");
    }
}

function textboxValue($value){
    $textbox = mysqli_real_escape_string($GLOBALS['con'], trim($_POST[$value]));
    if(empty($textbox)){
        return false;
    }else{
        return $textbox;
    }
}


function TextNode($classname, $msg){
    $element = "<h6 class='$classname'>$msg</h6>";
    echo $element;
}


function getData(){
    $sql = "SELECT * FROM Livro";

    $result = mysqli_query($GLOBALS['con'], $sql);

    if(mysqli_num_rows($result) > 0){
        return $result;
    }
}

function UpdateData(){
    $livro_id = textboxValue("livro_id");
    $titulo_livro = textboxValue("titulo_livro");
    $editora = textboxValue("editora");
    $preco = textboxValue("preco");

    if($titulo_livro && $editora && $preco){
        $sql = "
            UPDATE Livro SET titulo_livro='$titulo_livro', editora = '$editora', preco = '$preco' WHERE livro_id='$livro_id';                    
        ";

        if(mysqli_query($GLOBALS['con'], $sql)){
            TextNode("success", "Dado atualizado com sucesso");
        }else{
            TextNode("error", "Não foi possível atualizar esse dado");
        }

    }else{
        TextNode("error", "Selecione o dado atráves do botão de edição");
    }


}


function deleteRecord(){
    $livro_id = (int)textboxValue("livro_id");

    $sql = "DELETE FROM Livro WHERE livro_id=$livro_id";

    if(mysqli_query($GLOBALS['con'], $sql)){
        TextNode("success","Registro deletado com sucesso...!");
    }else{
        TextNode("error","Não foi possível deletar o registro...!");
    }

}


function deleteBtn(){
    $result = getData();
    $i = 0;
    if($result){
        while ($row = mysqli_fetch_assoc($result)){
            $i++;
            if($i > 3){
                buttonElement("btn-deleteall", "btn btn-danger" ,"<i class='fas fa-trash'></i> Delete All", "deleteall", "");
                return;
            }
        }
    }
}


function deleteAll(){
    $sql = "DROP TABLE Livro";

    if(mysqli_query($GLOBALS['con'], $sql)){
        TextNode("success","Todos os registros foram excluídos com sucesso...!");
        Createdb();
    }else{
        TextNode("error","Algo deu errado e os registros não foram excluídos...!");
    }
}

function setID(){
    $getid = getData();
    $livro_id = 0;
    if($getid){
        while ($row = mysqli_fetch_assoc($getid)){
            $livro_id = $row['livro_id'];
        }
    }
    return ($livro_id + 1);
}