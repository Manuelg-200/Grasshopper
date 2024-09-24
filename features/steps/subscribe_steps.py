from behave import *
from features.pages.registrationForm_page import *

URL = 'http://localhost/Grasshopper/authentication/RegistrationForm.php'

default_name = 'John'
default_surname = 'Tester'
default_email = 'JohnTester@Test.te'
default_password = 'password'
default_confirm_password = 'password'

@Given('I am in the registration page')
def step_impl(context):
    context.driver.get(URL)

@When('I subscribe')
def step_impl(context):
    context.RegistrationFormPage = RegistrationFormPage(context.driver)
    context.RegistrationFormPage.fill_in_everything(default_name, default_surname, default_email, 
                                                    default_password, default_confirm_password)
    context.RegistrationFormPage.click_subscribe()

@Then('I should see a confirmation message')
def step_impl(context):
    assert 'Sei stato registrato correttamente!' in context.driver.page_source