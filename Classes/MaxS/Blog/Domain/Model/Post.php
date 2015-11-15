<?php
namespace MaxS\Blog\Domain\Model;

/*                                                                        *
 * This script belongs to the TYPO3 Flow package "MaxS.Blog".             *
 *                                                                        *
 *                                                                        */

use \MaxS\Blog\Domain\Model\Blog;
use TYPO3\Flow\Annotations as Flow;
use Doctrine\ORM\Mapping as ORM;

/**
 * @Flow\Entity
 */
class Post {

	/**
	 * @Flow\Validate(type="NotEmpty")
	 * @ORM\ManyToOne(inversedBy="posts")
	 * @var Blog
	 */
	protected $blog;

	/**
   * @Flow\Validate(type="NotEmpty")
   * @var string
   */
	protected $title;

	/**
	 * @var \DateTime
	 */
	protected $date;

	/**
	 * @Flow\Validate(type="NotEmpty")
	 * @var string
	 */
	protected $author;

	/**
	 * @Flow\Validate(type="NotEmpty")
	 * @ORM\Column(type="text")
	 * @var string
	 */
	protected $content;

	/**
	 * Constructs this post
	 */
	public function __construct() {
		$this->date = new \DateTime();
	}


	/**
	 * @return Blog
	 */
	public function getBlog() {
		return $this->blog;
	}

	/**
	 * @param Blog $blog
	 * @return void
	 */
	public function setBlog($blog) {
		$this->blog = $blog;
		$this->blog->addPost($this);
	}

	/**
	 * @return string
	 */
	public function getTitle() {
		return $this->title;
	}

	/**
	 * @param string $title
	 * @return void
	 */
	public function setTitle($title) {
		$this->title = $title;
	}

	/**
	 * @return \DateTime
	 */
	public function getDate() {
		return $this->date;
	}

	/**
	 * @param \DateTime $date
	 * @return void
	 */
	public function setDate($date) {
		$this->date = $date;
	}

	/**
	 * @return string
	 */
	public function getAuthor() {
		return $this->author;
	}

	/**
	 * @param string $author
	 * @return void
	 */
	public function setAuthor($author) {
		$this->author = $author;
	}

	/**
	 * @return string
	 */
	public function getContent() {
		return $this->content;
	}

	/**
	 * @param string $content
	 * @return void
	 */
	public function setContent($content) {
		$this->content = $content;
	}

}
