<?php
class AdminController extends Controller
{
    public $layout = '//layouts/main';
    public function actionIndex()
    {
        $this->render('/admin/index');
    }
}