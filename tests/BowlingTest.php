<?php declare(strict_types=1);

use PHPUnit\Framework\TestCase;

require "src/Bowling.php";

class BowlingTest extends TestCase {

  public function testFrame() {
    $f1 = new Frame(10);
    $f1->roll(8);
    $f1->roll(2);
    $this->assertEquals(false, $f1->isFinished());
    $this->assertEquals(10, $f1->score());
    $f1->roll(2);
    $this->assertEquals(12, $f1->score());
  }

  public function testRollWith3() {
    $game = new Bowling();
    $game->roll(3);
    $this->assertEquals(3, $game->score());
  }

  public function testRollWith3Then4() {
    $game = new Bowling();
    $game->roll(3);
    $game->roll(4);
    $this->assertEquals(7, $game->score());
  }

  public function testRollWithUnfinishedStrike() {
    $game = new Bowling();
    $game->roll(10);
    $this->assertEquals(10, $game->score());
  }

  public function testRollWithHalfFinishedStrikeShouldNotAddAnyExtraPoint() {
    $game = new Bowling();
    $game->roll(10);
    $game->roll(2);
    $this->assertEquals(12, $game->score());
  }

  public function testRollWithStrikeThenSpare() {
    $game = new Bowling();
    $game->roll(10);
    $game->roll(2);
    $game->roll(8);
    $game->roll(2);
    $this->assertEquals(34, $game->score());
  }

  public function testRollWith9StrikesAndFinalSpare() {
    $game = new Bowling();
    $game->roll(10);
    $game->roll(10);
    $game->roll(10);
    $game->roll(10);
    $game->roll(10);
    $game->roll(10);
    $game->roll(10);
    $game->roll(10);
    $game->roll(10);
    $game->roll(8);
    $game->roll(2);
    $game->roll(0);
    $this->assertEquals(268, $game->score());
  }

  public function testRollWith12Strikes() {
    $game = new Bowling();
    $game->roll(10);
    $game->roll(10);
    $game->roll(10);
    $game->roll(10);
    $game->roll(10);
    $game->roll(10);
    $game->roll(10);
    $game->roll(10);
    $game->roll(10);
    $game->roll(10);
    $game->roll(10);
    $game->roll(10);
    $this->assertEquals(300, $game->score());
  }

  public function testRollWith11StrikesAndASpare() {
    $game = new Bowling();
    $game->roll(10); // 10 + 10 + 5
    $game->roll(10); // 10 + 5 + 5
    $game->roll(5);  // 5
    $game->roll(5);  // 5 + 10
    $game->roll(10); // 30
    $game->roll(10); // 30
    $game->roll(10); // 30
    $game->roll(10); // 30
    $game->roll(10); // 30
    $game->roll(10); // 30
    $game->roll(10); // 30
    $game->roll(10);
    $game->roll(10);
    $this->assertEquals(275, $game->score());
  }

  public function testRollWithStrike() {
    $game = new Bowling();
    $game->roll(10);
    $game->roll(2);
    $game->roll(2);
    $this->assertEquals(18, $game->score());
  }

  public function testRollWithSpare() {
    $game = new Bowling();
    $game->roll(3);
    $game->roll(7); // Spare = 10 + 2
    $game->roll(2); // 2
    $this->assertEquals(14, $game->score());
  }

  public function testRollWithSpareFollowedByBasicNumbers() {
    $game = new Bowling();
    $game->roll(3);
    $game->roll(7);
    $game->roll(2);
    $game->roll(2);
    $this->assertEquals(16, $game->score());
  }

  public function testRollWithoutSpare() {
    $game = new Bowling();
    $game->roll(2);
    $game->roll(3);
    $game->roll(5);
    $game->roll(4);
    $this->assertEquals(14, $game->score());
  }

  public function testRollWithoutSpareForAWhile() {
    $game = new Bowling();
    $game->roll(4);
    $game->roll(4);
    $game->roll(5);
    $game->roll(4);
    $game->roll(1);
    $game->roll(4);
    $game->roll(4);
    $this->assertEquals(26, $game->score());
  }



}

?>
