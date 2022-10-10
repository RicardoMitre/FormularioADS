<?php
//dados do formulario
$nome = $_POST["nome"];
$genero = $_POST["genero"];
$data = $_POST["data_nasc"];
$telefone = $_POST["tel"];
$email = $_POST["email"];
$arquivo =  'arquivo.txt';

//Variaveis
$openarq = fopen($arquivo, 'a');
$object = new stdClass;
$link = 'formulario.html';

//Fincção de redirecionamento
function redireciona($link){
    if ($link==-1){
    echo" <script>history.go(-1);</script>";
    }else{
    echo" <script>document.location.href='$link'</script>";
    }
};

//Nome
if  (!preg_match( "/^[a-zA-z]*$/" ,  $nome )) {  
    echo '<script>alert ("'.$nome.' não é um nome valido")</script>';
    redireciona($link);
}  else  {
    $object->nome = $nome;
}

//genero
$object->genero = $genero;

//data de Nascimento
$object->data = $data;

//telefone
$telefone = filter_var($telefone, FILTER_VALIDATE_INT);

if (!filter_var($telefone, FILTER_VALIDATE_INT) === false) {
    $object->telefone = $telefone;   
} else {
    echo '<script>alert ("'.$telefone.' não é um telefone valido")</script>';
    redireciona($link);    
}

//email
$email = filter_var($email, FILTER_VALIDATE_EMAIL);

if (!filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
   
    $object->email = $email;
} else {
    echo '<script>alert ("'.$email.' não é um email valido")</script>';
    redireciona($link);
}
//Codificar e decodificar
$json = json_encode($object);
$data = json_decode($json);

//Salvar no arquivo txt e escrever na tela
foreach($data as $kay => $vaule){
    $item = "$kay: $vaule \n";
    echo "$item <br>";
    fwrite($openarq, $item);
}
//fechar arquivo txt
fclose($openarq);
?>

