<?php

namespace App\Models;

use CodeIgniter\Model;

class StatusModel extends Model
{
    protected $table = 'status';
    protected $primaryKey = 'status_id';
    protected $allowedFields = ['nama_status', 'created_at', 'updated_at'];
    protected $returnType = 'array';

    public function determineNextStatus($currentStatusID)
    {
        // Fetch all statuses ordered by status_id
        $statuses = $this->orderBy('status_id', 'ASC')
            ->findAll();  // Get all statuses

        // Extract status_id and nama_status from the result
        $statusOptions = [];
        foreach ($statuses as $status) {
            $statusOptions[] = [
                'value' => $status['status_id'],
                'label' => $status['nama_status']
            ];
        }

        // Determine the next status based on the current status
        $currentKeyIndex = array_search($currentStatusID, array_column($statusOptions, 'value'));
        $nextKeyIndex = ($currentKeyIndex !== false && $currentKeyIndex + 1 < count($statusOptions))
            ? $currentKeyIndex + 1
            : 0;

        return $statusOptions[$nextKeyIndex];
    }
}
