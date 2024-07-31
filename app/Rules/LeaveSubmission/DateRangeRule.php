<?php

namespace App\Rules\LeaveSubmission;

use Closure;
use Illuminate\Contracts\Validation\DataAwareRule;
use Illuminate\Contracts\Validation\ValidationRule;

class DateRangeRule implements ValidationRule, DataAwareRule
{
    private $minLeaveDayInterval = 3;
    protected $data = [];

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
            $fail(__('leave-submission.invalid-date-range'));
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
        $requestDate = \DateTimeImmutable::createFromFormat('Y-m-d', $this->data['request_date']);
        $dayInteval = intval($requestDate->diff($dateStart)->format("%a"));
        return $dayInteval >= $this->minLeaveDayInterval;
    }

    private function validateDateStartAndDateEnd(
        \DateTimeInterface $dateStart, 
        \DateTimeInterface $dateEnd): bool {
            $dateIntervalSymbol = $dateStart->diff($dateEnd)->format("%R");
            return $dateIntervalSymbol == '+';
    }

    public function setData(array $data)
    {
        $this->data = $data;
        return $this;
    }
}
