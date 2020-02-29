<?php declare(strict_types=1);

class Frame {
  public $rolls;
  public $frameNumber;
  public $nextFrame;

  public function __construct($frameNumber) {
    $this->rolls = array();
    $this->frameNumber = $frameNumber;
  }

  public function roll($roll) {
    array_push($this->rolls, $roll);
  }

  public function isFinished() {
    if ($this->frameNumber == 10)
      return false;
    else
      return count($this->rolls) == 2 || $this->isStrike();
  }

  public function score() {
    if ($this->isStrike()) {
      $nextRollsToAdd = 2;
    } else if ($this->isSpare()) {
      $nextRollsToAdd = 1;
    } else {
      $nextRollsToAdd = 0;
    }

    if ($this->frameNumber != 10 && $this->nextFrame) {
      return array_sum($this->rolls) +
        array_sum($this->nextFrame->getRolls($nextRollsToAdd));
    } else {
      return array_sum($this->rolls);
    }
  }

  protected function isStrike() {
    return current($this->rolls) == 10;
  }

  protected function isSpare() {
    return !$this->isStrike() && array_sum($this->rolls) == 10;
  }

  public function getRolls($numberOfRoll) {
    if ($numberOfRoll <= count($this->rolls)) {
      return array_slice($this->rolls, 0, $numberOfRoll);
    } else if ($this->nextFrame) {
      return array_merge(
        $this->rolls,
        $this->nextFrame->getRolls($numberOfRoll - count($this->rolls))
      );
    } else {
      return [];
    }
  }
}

class Bowling {
  public $frames;

  public function __construct() {
    $this->frames = array(new Frame(1));
  }

  public function roll($numberDown) {
    $lastFrame = end($this->frames);
    $lastFrame->roll($numberDown);

    if ($lastFrame->isFinished()) {
      $newFrame = new Frame($lastFrame->frameNumber + 1);
      $lastFrame->nextFrame = $newFrame;
      array_push($this->frames, $newFrame);
    }
  }

  public function score() {
    return array_sum(
      array_map(
        function ($frame) {
          return $frame->score();
        },
        $this->frames
      )
    );
  }
}
?>
