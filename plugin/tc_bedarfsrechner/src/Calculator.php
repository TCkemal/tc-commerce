<?php declare(strict_types=1);

namespace Plugin\tc_bedarfsrechner\src;

class Calculator
{
    public function calculate(float $area, float $packageSize, float $wastePercent = 0): array
    {
        if ($area <= 0) {
            throw new \InvalidArgumentException('Die Fläche muss größer als 0 sein.');
        }

        if ($packageSize <= 0) {
            throw new \InvalidArgumentException('Die Paketgröße muss größer als 0 sein.');
        }

        $requiredArea = $area * (1 + ($wastePercent / 100));
        $packages     = (int)ceil($requiredArea / $packageSize);
        $coveredArea  = $packages * $packageSize;

        return [
            'inputArea'     => round($area, 2),
            'wastePercent'  => round($wastePercent, 2),
            'requiredArea'  => round($requiredArea, 2),
            'packageSize'   => round($packageSize, 3),
            'packages'      => $packages,
            'coveredArea'   => round($coveredArea, 2),
            'remainingArea' => round($coveredArea - $requiredArea, 2),
        ];
    }
}
