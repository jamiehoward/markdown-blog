<?php

namespace Tests\Unit;

use App\Blog;
use PHPUnit\Framework\TestCase;

class BlogTest extends TestCase
{
	public function testThatDirectoryCanBeSet()
	{
		$blog = new Blog;
		$directory = './notes';
		$blog->setDirectory($directory);

		$this->assertInstanceOf(\App\NoteDirectory::class, $blog->getDirectory());
	}
}