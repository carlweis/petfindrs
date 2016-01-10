<?php
namespace App\Http\Controllers\V1\Locations;

use App\Http\Controllers\ApiController;
use App\PetFindrs\Locations\Countries\CountryRepository;
use App\PetFindrs\Locations\Countries\CountryTransformer;
use League\Fractal\Manager;
use League\Fractal\Resource\Collection;

class CountryController extends ApiController
{
    /**
     * @var CountryRepository
     */
    private $countryRepository;

    /**
     * CountryController constructor.
     *
     * @param CountryRepository $countryRepository
     */
    public function __construct(CountryRepository $countryRepository)
    {
        $this->countryRepository = $countryRepository;
    }

    /**
     * Returns all countries.
     *
     * @param Manager $fractal
     * @param CountryTransformer $countryTransformer
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(Manager $fractal, CountryTransformer $countryTransformer)
    {
        $countries = $this->countryRepository->all();
        $collection = new Collection($countries, $countryTransformer);
        $data = $fractal->createData($collection)->toArray();

        if (!$data) {
            return $this->respondWithError('No Countries Available');
        }
        return $this->respondWithCORS($data);
    }
}