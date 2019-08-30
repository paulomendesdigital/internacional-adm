<?php

namespace App\Traits;

trait Price
{
    public function formatPriceToView($prices)
    {
        if (is_array($prices))
            return $this->formatManyPricesToView($prices);

        $pricesFormatted[] = $this->formatOnePriceToView($prices);

        return $pricesFormatted;

    }

    public function formatPriceToDB($prices)
    {
        if (is_array($prices))
            return $this->formatManyPricesToDB($prices);

        $formattedPrices[] = $this->formatOnePriceToDB($prices);

        return $formattedPrices;
    }

    private function formatManyPricesToView($prices)
    {
        $formattedPrices = [];

        foreach ($prices as $key => $price) {

            $formattedPrices[$key] = $this->formatOnePriceToView($price);

        }

        return $formattedPrices;
    }

    private function formatOnePriceToView($price)
    {
        $formattedPrice = '';

        if (!empty($price))
            $formattedPrice = number_format($price, 2, ',', '.');

        return $formattedPrice;
    }

    private function formatManyPricesToDB($prices)
    {
        $formattedPrices = [];

        foreach ($prices as $key => $price) {

            $price = $this->formatOnePriceToDB($price);

            if(!empty($price))
                $formattedPrices[$key] = ['price' => $price];

        }

        return $formattedPrices;
    }

    private function formatOnePriceToDB($price)
    {
        $formattedPrice = '';

        if (!empty($price)) {
            $formattedPrice = str_replace('.', '', $price);

            $formattedPrice = str_replace(' ', '', $formattedPrice);

            $formattedPrice = str_replace('R$', '', $formattedPrice);

            $formattedPrice = str_replace(',', '.', $formattedPrice);
        }

        return $formattedPrice;

    }
}
