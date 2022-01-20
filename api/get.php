<?php
require('../config.php');
$method = strtolower($_SERVER['REQUEST_METHOD']);

if($method === 'get'){
    // esse codigo abaixo reproz o que comentei
    $id = filter_input(INPUT_GET, 'id');

/*     if(isset($_GET['id'])){
        $id = $_GET['id'];
    }else{
        $id = null;
    } */

    if($id){

        $sql = $pdo->prepare('SELECT * FROM notes WHERE id= :id');
        $sql->bindValue(':id', $id);
        $sql->execute();

        if($sql->rowCount() >0){

            $data = $sql->fetch(PDO::FETCH_ASSOC);
            $array['result'] =['id'=> $data['id'],'title'=> $data['title'], 'body'=> $data['body']];

        }else{
            $array['error'] = 'id não existe';
        }


    }else{
        $array['error'] = 'id não enviado';
    }

}else{
    $array['error'] = 'Method não permitido';
}

require('../return.php');

exit;