<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Toast extends Component
{
  public $valerrors;
  public $message;
  public $type;

  /**
   * Create a new component instance.
   *
   * @param string $message
   * @param string $valerrors
   * @param string $type
   */
  public function __construct($message, $valerrors = [], $type = 'success')
  {
    $this->valerrors = $valerrors;
    $this->message = $message;
    $this->type = $type;
  }

  /**
   * Get the view / contents that represent the component.
   */
  public function render(): View|Closure|string
  {
    return view('components.toast');
  }
}
