from behave import *
from features.pages.header_page import *

HOMEPAGE_URL = 'http://localhost/Grasshopper'

@Given('I am unlogged in the index page')
def step_impl(context):
    context.driver.get(HOMEPAGE_URL)
    context.header = HeaderPage(context.driver)

#TODO
@Given('I am logged in the index page')
def step_impl(context):
    context.driver.get()

@When('I click on the {button} button')
def step_impl(context, button):
    context.header.click_button(button)

@Then("I should be taken to the {page} page")
def step_impl(context, page):
    if page == 'LoginForm' or page == 'RegistrationForm':
        expected_url = f"{HOMEPAGE_URL}/authentication/{page}.php"
    elif page == 'shop':
        expected_url = f"{HOMEPAGE_URL}/shop/shop.php"
    elif page == 'show_profile':
        expected_url = f"{HOMEPAGE_URL}/profile/show_profile.php"
    else:
        expected_url = f"{HOMEPAGE_URL}/{page}.php"
    assert context.driver.current_url == expected_url, f"Expected URL: {expected_url}, Actual URL: {context.driver.current_url}"