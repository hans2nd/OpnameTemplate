<?php

function check_already_login()
{
	$ci = &get_instance();
	$user_session = $ci->session->userdata('username');
	if ($user_session) {
		redirect('home');
	}
}

function check_not_login()
{
	$ci = &get_instance();
	$user_session = $ci->session->userdata('username');
	if (!$user_session) {
		redirect('auth');
	}
}

function check_admin()
{
	$ci = &get_instance();
	$ci->load->library('fungsi');
	if ($ci->fungsi->user_login()->level != 'Admin') {
		redirect('home');
	}
}

