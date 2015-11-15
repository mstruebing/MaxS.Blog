<?php
namespace MaxS\Blog\Command;

/*                                                                        *
 * This script belongs to the TYPO3 Flow package "MaxS.Blog".             *
 *                                                                        *
 *                                                                        */

use MaxS\Blog\Domain\Model\Blog;
use MaxS\Blog\Domain\Model\Post;
use MaxS\Blog\Domain\Repository\BlogRepository;
use MaxS\Blog\Domain\Repository\PostRepository;
use TYPO3\Flow\Annotations as Flow;
use TYPO3\Flow\Cli\CommandController;

/**
 * @Flow\Scope("singleton")
 */
class BlogCommandController extends \TYPO3\Flow\Cli\CommandController {

	/**
	 * @Flow\Inject
	 * @var BlogRepository
	 */
	protected $blogRepository;

	/**
	 * @Flow\Inject
	 * @var PostRepository
	 */
	protected $postRepository;

	/**
   * A command to setup a blog
   *
   * With this command you can kickstart a new blog.
   *
   * @param string $blogTitle the name of the blog to create
   * @param string $blogDescription the description of the blog to create
   * @param boolean $reset set this flag to remove all previously created blogs and posts
   * @return void
   */
	public function setupCommand($blogTitle, $blogDescription, $reset = FALSE) {
		if ($reset) {
			$this->blogRepository->removeAll();
			$this->postRepository->removeAll();
		}

		$blog = new Blog($blogTitle);
		$blog->setDescription($blogDescription);
		$this->blogRepository->add($blog);

		$post = new Post();
		$post->setBlog($blog);
		$post->setAuthor('John Doe');
		$post->setTitle('Example Post');
		$post->setContent('You think water moves fast? You should see ice. It moves like it has a mind. Like it knows it killed the world once and got a taste for murder. After the avalanche, it took us a week to climb out. Now, I don\'t know exactly when we turned on each other, but I know that seven of us survived the slide... and only five made it out. Now we took an oath, that I\'m breaking now. We said we\'d say it was the snow that killed the other two, but it wasn\'t. Nature is lethal but it doesn\'t hold a candle to man.');
		$this->postRepository->add($post);

		$this->outputLine('Successfully created a blog %s', [$blogTitle]);
	}
}
