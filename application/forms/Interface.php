<?php
interface Application_Form_Interface
{
	public function init();
	
	public function create();
	
	public function update($data);
	
	public function delete();
}