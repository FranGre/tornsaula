<?php

namespace App\Livewire;

use App\Models\Question;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class SearchQuestions extends Component
{
    use WithPagination;

    public $search = '';
    protected $queryString = ['search'];
    public $questions = [];
    public $module_id;
    public $pending;

    public function updated()
    {
        $this->resetPage();
        $this->searchQuestions();
    }

    public function mount()
    {
        $this->searchQuestions();
    }

    public function searchQuestions()
    {
        // My questions
        if (!isset($this->module_id)) {
            if (empty($this->search)) {
                $this->questions = Question::where('user_id', Auth::user()->id)
                    ->orderByDesc('created_at')->get();
                return;
            } else {
                $results = Question::search($this->search)->raw()['hits'];
                $ids = array_column($results, 'id');
                $this->questions = Question::whereIn('id', $ids)->where('user_id', Auth::user()->id)
                    ->orderByDesc('created_at')->get();
                return;
            }
        }

        // Module's questions
        if (isset($this->module_id)) {
            // All
            if (!$this->pending) {
                if (empty($this->search)) {
                    $this->questions = Question::where('module_id', $this->module_id)
                        ->orderByDesc('created_at')->get();
                    return;
                } else {
                    $results = Question::search($this->search)->raw()['hits'];
                    $ids = array_column($results, 'id');
                    $this->questions = Question::whereIn('id', $ids)->where('module_id', $this->module_id)
                        ->orderByDesc('created_at')->get();
                    return;
                }
            } else {
                // Pending
                if (empty($this->search)) {
                    $this->questions = Question::whereDoesntHave('answer')
                        ->where('module_id', $this->module_id)
                        ->orderByDesc('created_at')->get();
                    return;
                } else {
                    $results = Question::search($this->search)->raw()['hits'];
                    $ids = array_column($results, 'id');
                    $this->questions = Question::whereIn('id', $ids)
                        ->whereDoesntHave('answer')
                        ->where('module_id', $this->module_id)
                        ->orderByDesc('created_at')->get();
                    return;
                }
            }
        }
    }

    public function render()
    {
        $questions = $this->questions;

        return view('livewire.search-questions', compact('questions'));
    }
}
