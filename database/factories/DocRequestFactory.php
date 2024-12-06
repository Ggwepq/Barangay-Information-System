<?php

namespace Database\Factories;

use App\Models\DocumentRequest;
use App\Models\Resident;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class DocRequestFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = DocumentRequest::class;

    public function definition(): array
    {
        $type = fake()->randomElement(['Certificate of Indigency', 'Barangay Certificate']);
        $status = fake()->randomElement(['Pending', 'Approved', 'Rejected']);
        $purpose = fake()->sentence(1);
        $request = fake()->dateTimeThisMonth();

        if ($status == 'Pending') {
            $approved = null;
        } else {
            $approved = Carbon::now();
        }

        return [
            'resident_id' => Resident::all()->random()->id,
            'document_type' => $type,
            'purpose' => $purpose,
            'requested_at' => $request,
            'approved_at' => $approved,
            'status' => $status,
        ];
    }
}
