from behave import *
from features.pages.registrationForm_page import *

URL = 'http://localhost/Grasshopper/authentication/RegistrationForm.php'

default_name = 'John'
default_surname = 'Tester'
default_email = 'JohnTester@Test.te'
default_password = 'password'
default_confirm_password = 'password'


#       ---- General functions ----
@Given('I am in the registration page')
def step_impl(context):
    context.driver.get(URL)
    context.RegistrationFormPage = RegistrationFormPage(context.driver)

@When('I insert valid data in the form')
def step_impl(context):
    context.RegistrationFormPage.fill_in_everything(default_name, default_surname, default_email, 
                                                    default_password, default_confirm_password)

#      ---- Fields related functions ----
@When('I insert a {name} in the field that is not valid')
def step_impl(context, name):
    context.RegistrationFormPage.fill_field("name", name)

@Then('The {field} field should be colored red')
def step_impl(context, field):
    assert 'input input-error' in context.RegistrationFormPage.get_field_class(field)

@Then('The form fields should be colored green')
def step_impl(context):
    assert 'input input-ok' in context.RegistrationFormPage.get_field_class('name')
    assert 'input input-ok' in context.RegistrationFormPage.get_field_class('surname')
    assert 'input input-ok' in context.RegistrationFormPage.get_field_class('email')
    assert 'input input-ok' in context.RegistrationFormPage.get_field_class('password')
    assert 'input input-ok' in context.RegistrationFormPage.get_field_class('confirm_password')

@Then('An {error} message should be displayed')
def step_impl(context, error):
    assert error in context.driver.page_source
    
#       ---- Submit button related functions ----
@When('I click the submit button')
def step_impl(context):
    context.RegistrationFormPage.click_subscribe()

@Then('The submit button should be disabled')
def step_impl(context):
    assert not context.RegistrationFormPage.subscribe_button.is_enabled()

@Then('The submit button should be enabled')
def step_impl(context):
    assert context.RegistrationFormPage.subscribe_button.is_enabled()

#       ---- Confirmation page related functions ----
@Then('I should see a confirmation message')
def step_impl(context):
    assert 'Sei stato registrato correttamente!' in context.driver.page_source