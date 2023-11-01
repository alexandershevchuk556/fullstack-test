<?php

namespace App\Controllers;

use App\Models\Comment;
use CodeIgniter\I18n\Time;

class Home extends BaseController
{
	public function index()
	{
		$sortType = $this->request->getGet('sortType');
		$sortDir = $this->request->getGet('sortDir');
		$comments = model(Comment::class);
		return view('comments', [
			'comments' => $comments->orderBy($sortType ?: 'created_at', $sortDir ?: 'asc')->paginate(3),
			'pager' => $comments->pager,
			'sort' => ['sortType' => $sortType, 'sortDir' => $sortDir]
		]);
	}

	public function addComment()
	{

		$userModel = model(Comment::class);
		$userModel->insert([
			'text' => $this->request->getPost('text'),
			'user_id' => $this->request->getPost('user_id'),
			'created_at' => $myTime = new Time('now'),
			'updated_at' => $myTime = new Time('now'),
		]);

		return redirect()->route('/');
	}

	public function deleteComment()
	{
		$userModel = model(Comment::class);
		$userModel->delete($this->request->getGet('id'));

		return redirect()->route('/');
	}
}
