<?php
if (!$this->authex->logged_in())
{ redirect("auth"); }
//$this->output->enable_profiler(TRUE);
Authex::checkUrlPermission();
