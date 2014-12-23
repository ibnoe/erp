<?php

if (!$this->authex->logged_in())
{

	// they are not logged in

	redirect("auth/login");
}
else
{
	if (($this->authex->get_user_level() > 3))
	{
		redirect("error/");
	}
}
