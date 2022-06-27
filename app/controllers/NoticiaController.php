<?php


class NoticiaController extends ControllerBase
{
    private $mensagemDeErro = '';

    public function listaAction()
    {
        $this->view->noticias = Noticia::find();

        if (!isset($this->view->noticias)) {
            $this->flash->error('Um erro inesperado ocorreu ao carregar as notícias.');
        }

        $this->view->pick("noticia/listar");
    }

    public function cadastrarAction()
    {
        $this->view->pick("noticia/cadastrar");
    }

    public function editarAction($id)
    {
        $this->view->noticia = Noticia::findFirst($id);
       
        $this->view->pick("noticia/editar");
    }

    public function salvarAction()
    {
        $title = $this->request->getPost('titulo');
        $text = $this->request->getPost('texto');

        if (strlen($text) > 255) {
            $this->flash->error('O texto deve possuir no máximo 255 caracteres');

            return $this->response->redirect(array('for' => 'noticia.listar'));
        }

        if (null !== $this->request->getPost('id')) {

            $id = $this->request->getPost('id');
            $noticia = Noticia::findFirst($id);

        } else {

            $noticia = new Noticia();
            $noticia->setRegisterDate();

        }
        
        $noticia->setTitle($title);
        $noticia->setText($text);
        $noticia->setLastUpdateDate();

        if ($noticia->save()) {
            $this->flash->success('Notícia registrada com sucesso');
        }
        else {
            $this->flash->error('Ocorreu um erro inesperado.');
        }

        return $this->response->redirect(array('for' => 'noticia.lista'));

    }

     public function excluirAction($id)
     {
        $noticia = Noticia::findFirst($id);

        if (isset($noticia)) {
            if ($noticia->delete()) {
                $this->flash->success('Notícia excluída com sucesso.');
            } else {
                $this->flash->error('Ocorreu um erro inesperado.');
            }
        } else {
           $this->flash->error('Não existe uma notícia com esse ID.');
        }

        return $this->response->redirect(array('for' => 'noticia.lista'));
     }

}