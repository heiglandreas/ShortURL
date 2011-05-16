<?php


class Admin_IndexController extends Heigl_Controller_Action
{

	public function indexAction()
    {
		$this -> view -> assign ( 'title', 'Your LinkShortener' );
		// action body
	}
}

