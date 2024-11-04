<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Schema;

class ProjectCreateJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected int $projectId;
    protected string $projectName;

    /**
     * Create a new job instance.
     */
    public function __construct(int $projectId, string $projectName)
    {
        $this->projectId = $projectId;
        dump($this->projectId);
        $this->projectName = str_replace(' ', '_', strtolower($projectName));
        dump($this->projectName);
    }


    public function handle(): void
    {
            $tableName = 'project_' . $this->projectId . '_' . $this->projectName;
    
            if (!Schema::hasTable($tableName)) {
                Schema::create($tableName, function (Blueprint $table) {
                    $table->id();
                    $table->foreignId('project_id')->constrained('project_master')->onDelete('cascade');
                    $table->string('task_name');
                    $table->text('task_description')->nullable();
                    $table->date('due_date')->nullable();
                    $table->timestamps();
                });
            }
    }
}
