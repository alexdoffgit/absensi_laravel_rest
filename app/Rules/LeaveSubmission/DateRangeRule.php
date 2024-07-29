<?php

namespace App\Rules\LeaveSubmission;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class DateRangeRule implements ValidationRule
{
    private $minLeaveDayInterval = 3;
    private $today = new \DateTimeImmutable();
    // private $today = \DateTimeImmutable::createFromFormat('Y-m-d', '2023-01-01');

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $date = $this->getDateRangeFromFormValue($value);
        $validDateStart = $this->validateDateStart($date['start']);
        if (!$validDateStart) {
            $fail(__('leave-submission.invalid-date-start'));
        }
        $validDateRange = $this->validateDateStartAndDateEnd($date['start'], $date['end']);
        if (!$validDateRange) {
            $fail(__('leave-submission.invalid-date-start'));
        }
    }

    /**
     * @param mixed $value
     * @return array{
     *   'start': \DateTimeInterface,
     *   'end': \DateTimeInterface
     * }
     */
    private function getDateRangeFromFormValue($value) 
    {
        $dateRange = explode(" - ", $value);
        $dateStart = \DateTimeImmutable::createFromFormat('Y-m-d', $dateRange[0]);
        $dateEnd = \DateTimeImmutable::createFromFormat('Y-m-d', $dateRange[1]);
        return [
            'start' => $dateStart,
            'end' => $dateEnd
        ];
    }

    private function validateDateStart(\DateTimeInterface $dateStart): bool
    {
        $dayInteval = intval($this->today->diff($dateStart)->format("%a"));
        return $dayInteval >= $this->minLeaveDayInterval;
    }

    private function validateDateStartAndDateEnd(
        \DateTimeInterface $dateStart, 
        \DateTimeInterface $dateEnd): bool {
            $dateIntervalSymbol = $dateStart->diff($dateEnd)->format("%R");
            return $dateIntervalSymbol == '+';
    }
}
