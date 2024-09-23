Feature: Header Buttons Click

    @smoke
    Scenario: Click on a navbar button
        Given I am anywhere on the site    
        When I click on the Chi Siamo button
        Then I should be taken to the companyBio page
        When I click on the Negozio button
        Then I should be taken to the shop page
        When I click on the Home button
        Then I should be taken to the index page
        When I click on the Accedi button
        Then I should be taken to the LoginForm page
        When I click on the Registrati button
        Then I should be taken to the RegistrationForm page
        
