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

    /**
     * Returns all active countries.
     *
     * @param Manager $fractal
     * @param CountryTransformer $countryTransformer
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function active(Manager $fractal, CountryTransformer $countryTransformer)
    {
        $countries = $this->countryRepository->active();
        $collection = new Collection($countries, $countryTransformer);
        $data = $fractal->createData($collection)->toArray();

        if (!$data) {
            return $this->respondWithError('No Active Countries Available');
        }
        return $this->respondWithCORS($data);
    }

    /**
     * Returns country by id.
     *
     * @param Manager $fractal
     * @param CountryTransformer $countryTransformer
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function find(Manager $fractal, CountryTransformer $countryTransformer, $id)
    {
        $countries = $this->countryRepository->find($id);
        $collection = new Collection($countries, $countryTransformer);
        $data = $fractal->createData($collection)->toArray();

        if (!$data) {
            return $this->respondWithError("No Country Found with id $id");
        }
        return $this->respondWithCORS($data);
    }

    /**
     * Returns country by code.
     *
     * @param Manager $fractal
     * @param CountryTransformer $countryTransformer
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function findByCode(Manager $fractal, CountryTransformer $countryTransformer, $code)
    {
        $countries = $this->countryRepository->findByCode($code);
        $collection = new Collection($countries, $countryTransformer);
        $data = $fractal->createData($collection)->toArray();

        if (!$data) {
            return $this->respondWithError("No Country Found with code $code");
        }
        return $this->respondWithCORS($data);
    }

    /**
     * Returns country by name.
     *
     * @param Manager $fractal
     * @param CountryTransformer $countryTransformer
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function findByName(Manager $fractal, CountryTransformer $countryTransformer, $name)
    {
        $name = ucwords(urldecode($name));
        $countries = $this->countryRepository->findByName($name);
        $collection = new Collection($countries, $countryTransformer);
        $data = $fractal->createData($collection)->toArray();

        if (!$data) {
            return $this->respondWithError("No Country Found with name $name");
        }
        return $this->respondWithCORS($data);
    }

    /**
     * Returns country by name.
     *
     * @param Manager $fractal
     * @param CountryTransformer $countryTransformer
     * @param $lat
     * @param $lon
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function findByLocation(Manager $fractal, CountryTransformer $countryTransformer, $lat, $lon)
    {
        $countries = $this->countryRepository->findByLocation($lat, $lon);
        $collection = new Collection($countries, $countryTransformer);
        $data = $fractal->createData($collection)->toArray();

        if (!$data) {
            return $this->respondWithError("No Country Found with location $lat, $lon");
        }
        return $this->respondWithCORS($data);
    }
}