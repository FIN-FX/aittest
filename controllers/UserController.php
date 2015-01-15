<?php

class UserController extends \Core\Controller
{
  function actionAddress($id)
  {
    $model = AddressModel::getInstance();
    $data = $model->getData($id);
    $view = $this->getView();
    $view->setRenderType('json');
    $view->render($data);
  }
}