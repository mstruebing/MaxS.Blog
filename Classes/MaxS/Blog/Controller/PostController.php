<?php
namespace MaxS\Blog\Controller;

/*                                                                        *
 * This script belongs to the TYPO3 Flow package "MaxS.Blog".             *
 *                                                                        *
 *                                                                        */

use TYPO3\Flow\Annotations as Flow;
use TYPO3\Flow\Mvc\Controller\ActionController;
use MaxS\Blog\Domain\Model\Post;

class PostController extends ActionController {

	/**
	 * @Flow\Inject
	 * @var \MaxS\Blog\Domain\Repository\PostRepository
	 */
	protected $postRepository;

	/**
	 * @Flow\Inject
	 * @var MaxS\Blog\Domain\Repository\BlogRepository
	 */
	protected $blogRepository;

	/**
	 * Index action
	 *
	 * @return string HTML code
	 */
	public function indexAction() {
		$blog = $this->blogRepository->findActive();
		$output = '
							<h1>Posts of "' . $blog->getTitle() . '"</h1>
							<ol>';

		foreach ($blog->getPosts() as $post) {
			$output .= '<li>'.$post->getTitle() . '</li>';
		}

		$output .= '</ol>';

		return $output;
	}

	/**
	 * @param \MaxS\Blog\Domain\Model\Post $post
	 * @return void
	 */
	public function showAction(Post $post) {
		$this->view->assign('post', $post);
	}

	/**
	 * @return void
	 */
	public function newAction() {
	}

	/**
	 * @param \MaxS\Blog\Domain\Model\Post $newPost
	 * @return void
	 */
	public function createAction(Post $newPost) {
		$this->postRepository->add($newPost);
		$this->addFlashMessage('Created a new post.');
		$this->redirect('index');
	}

	/**
	 * @param \MaxS\Blog\Domain\Model\Post $post
	 * @return void
	 */
	public function editAction(Post $post) {
		$this->view->assign('post', $post);
	}

	/**
	 * @param \MaxS\Blog\Domain\Model\Post $post
	 * @return void
	 */
	public function updateAction(Post $post) {
		$this->postRepository->update($post);
		$this->addFlashMessage('Updated the post.');
		$this->redirect('index');
	}

	/**
	 * @param \MaxS\Blog\Domain\Model\Post $post
	 * @return void
	 */
	public function deleteAction(Post $post) {
		$this->postRepository->remove($post);
		$this->addFlashMessage('Deleted a post.');
		$this->redirect('index');
	}

}
