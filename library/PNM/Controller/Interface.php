<?php
interface PNM_Controller_Interface
{
	public function init();
	
	public function indexAction();
	
	public function viewAction();
	
	public function createAction();
	
	public function updateAction();
	
	public function deleteAction();
}