<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\User;


class Auth extends BaseController
{
	public function registerView()
	{
		return view('register');
	}

	public function register()
	{

        $email = $this->request->getPost('email');
		$password = $this->request->getPost('password');

		$validationRules = [
			'email' => 'required|valid_email|is_unique[users.email]',
		];
		

		if (! $this->validate($validationRules)) {
            // The validation failed.
            return view('register', ['errors' => $this->validator->getErrors()]);
        }

		$userModel = model(User::class);
		$userModel->insert([
			'email'=> $email,
			'password'=> password_hash($password, PASSWORD_BCRYPT),
		]);

		$authenticationData = [
			'email'     => $email,
			'logged_in' => true,
		];
		$session = session();
		$session->set($authenticationData);
		return redirect()->route('/');
	}

	public function loginView()
	{
		return view('login');
	}

	public function login()
	{
        $email = $this->request->getPost('email');
		$password = $this->request->getPost('password');

		$userModel = model(User::class);
		if ($this->verifyUserCredentials($email, $password)) {

			$user = $userModel->where('email', $email)->where('password', password_hash($password, PASSWORD_BCRYPT))->first();
			$authenticationData = [
				'email'     => $email,
				'logged_in' => true,
			];
			$session = session();
			$session->set($authenticationData);
			return redirect()->route('/');
		}
		return view('login', ['errors'=> 'Wrong credentials']);
	}

	public function verifyUserCredentials($email, $password): bool
	{
		
		$userModel = model(User::class);
		$user = $userModel->where('email', $email)->first();

		if (is_null($user) || !password_verify($password, $user['password'])) {
			return false;
		}

		return true;
	}
}
