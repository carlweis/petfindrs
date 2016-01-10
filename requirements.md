# PetFindrs API Requirements

Build a REST API, which allows users to sign up and post 
listings of lost pets, along with an AngularJS client-side application 
to consume the API. Use OAuth token based authentication.

## Travis CI
Use for testing branches, before merging into master.

## Required Dependencies

## Resources

#### Locations
     - United States
      - All 50 States
       - Top 10 Cities
     *Resources*
     Country
      - Repository Interface
        - all
        - active
        - findByCode
        - findByName
        - findByLocation ( lat, lon)
     State
     
     City

## Endpoints

    - Locations
      - Countries
        /locations/countries - all
        /locations/countires/active - all active countries
        /locations/countries/code/{code} - country by code
        /locations/countries/name/{name} - country by name
        /locations/countries/location/{latitude}/{longitude} - country by location
      

## Tests

## Deployment
