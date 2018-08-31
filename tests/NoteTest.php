<?php

namespace Tests\Unit;

use App\Note;
use PHPUnit\Framework\TestCase;

class NoteTest extends TestCase
{
	public function setUp()
	{
		$this->createTestNote();
		$this->createTestPage();
	}

	protected function getTestNote()
	{
		$note = new Note(__DIR__ . '/../notes/new-note.md');

		return $note;
	}

	protected function getTestPage()
	{
		$note = new Note(__DIR__ . '/../notes/about.md');

		return $note;
	}

	protected function createTestNote()
	{
		if (! file_exists(__DIR__ . '/../notes/new-note.md')) {
			copy(__DIR__ . '/../notes/new-note.md.example', __DIR__ . '/../notes/new-note.md');
		}
	}

	protected function createTestPage()
	{
		if (! file_exists(__DIR__ . '/../notes/about.md')) {
			copy(__DIR__ . '/../notes/about.md.example', __DIR__ . '/../notes/about.md');
		}
	}

	public function testThatClassCanBeInstantiated()
	{
		$note = new Note;

		$this->assertInstanceOf(Note::class, $note);
	}

	public function testThatLocationCanBeSetAndRetrieved()
	{
		$location = __DIR__ . '/../notes/new-note.md';

		$note = new Note($location);

		$this->assertEquals($location, $note->getLocation());
	}

	public function testContentsCanBeRetrieved()
	{
		$note = $this->getTestNote();

		$testContentCheck = strpos($note->getContents(), 'Lorem ipsum');

		$this->assertGreaterThan(0, $testContentCheck);
	}

	public function testCanRetrieveTitle()
	{
		$note = $this->getTestNote();

		$this->assertEquals($note->getTitle(), '# New Note');
	}

	public function testCanRetrieveFormattedTitle()
	{
		$note = $this->getTestNote();

		$this->assertEquals($note->getTitle(true), 'New Note');
	}

	public function testCanRetrieveLink()
	{
		$note = $this->getTestNote();

		$this->assertEquals($note->getLink(), '/New+Note');
	}

	public function testCanDetermineNoteIsNotAPage()
	{
		$note = $this->getTestNote();

		$this->assertFalse($note->isPage());
	}

	public function testCanDetermineNoteIsAPage()
	{
		$note = $this->getTestPage();

		$this->assertTrue($note->isPage());
	}

	public function testCanRetrieveNoteTimestamp()
	{
		$note = $this->getTestNote();

		$this->assertEquals('2018-08-31', $note->getPublishDate()->format('Y-m-d'));
	}
}