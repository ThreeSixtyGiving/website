import os
import pytest
from selenium import webdriver
from selenium.webdriver.common.keys import Keys
from selenium.webdriver.common.by import By

from selenium.webdriver.support.wait import WebDriverWait
from selenium.webdriver import ActionChains
from selenium.webdriver.support import expected_conditions as EC


@pytest.fixture(scope="module")
def browser(request):
    browser = webdriver.Firefox()
    browser.implicitly_wait(1)
    request.addfinalizer(lambda: browser.quit())
    return browser


'''
Some Possible servers
live - http://www.threesixtygiving.org/ 
staging - http://opendataservic.staging.wpengine.com/
local test - http://opendataservic.wpengine.com/
'''    
@pytest.fixture(scope="module")
def server_url(request):
    if 'CUSTOM_SERVER_URL' in os.environ:
        return os.environ['CUSTOM_SERVER_URL']
    else:
        return "http://www.threesixtygiving.org/"


@pytest.mark.parametrize(('menu_text','sub_menu_text'), [
    ('Standard','Reference'),
    ('Standard','Identifiers'),
    ('Standard','Data Protection'),
    ('Standard','Licensing'),
    ('Standard','Register')
    ])
def test_drop_down_menus(server_url, browser, menu_text, sub_menu_text):
    browser.get(server_url)
    wait = WebDriverWait(browser, 1)

    menu = wait.until(EC.visibility_of_element_located((By.XPATH, "//ul[@id='menu-main-navigation']/li/a[text()='{0}']".format(menu_text))))
    ActionChains(browser).move_to_element(menu).perform()

    sub_menu = wait.until(EC.visibility_of_element_located((By.XPATH, "//li/a[text()='{0}']".format(sub_menu_text))))
    ActionChains(browser).move_to_element(sub_menu).click().perform()


def test_index_page(server_url,browser):
    browser.get(server_url)
    assert "360Giving | The more we know, the better grants we can make" in browser.title
    href = browser.find_element_by_xpath("//*[@id='post-17']/div[1]/div/div[3]/p[1]/a[1]")
    href = href.get_attribute("href")
    assert "http://www.threesixtygiving.org/get-involved/publish-your-data/" in href
    assert "NEWS" in browser.find_element_by_id("news").text
    assert "BLOG" not in browser.find_element_by_id("news").text


def test_cookie_message(server_url,browser):
    browser.get(server_url)
    assert "This site uses cookies: Find out more." in browser.find_element_by_tag_name('body').text
    assert "COOKIE POLICY" not in browser.find_element_by_tag_name('body').text


@pytest.mark.parametrize(('text'), [
    ('360Giving'),
    ('As soon as a step gives you an identifier, you can stop there and use the given identifier') #Bug #112
    ])
def test_identifiers_page(server_url,browser,text):
    browser.get(server_url + 'standard/identifiers/')
    assert text in browser.find_element_by_tag_name('body').text


def test_identifiers_page(server_url,browser):
    browser.get(server_url + 'standard/identifiers/')
    assert '360 Giving' not in browser.find_element_by_tag_name('body').text
    

@pytest.mark.parametrize(('text'), [
    ('360 Giving'),
    ('360 Bridge tool') #Bug #71
    ])
def test_standard_documentation_page(server_url,browser,text):
    browser.get(server_url + 'standard/reference/')
    assert text not in browser.find_element_by_tag_name('body').text


def test_standard_documentation_page(server_url,browser,text):
    browser.get(server_url + 'standard/reference/')
    #Bug #102
    assert 'Use the three-digit currency code from ISO 4217' not in browser.find_element_by_xpath("//*[@id='post-35']/div[1]/table[1]").text 


def test_standard_documentation_page(server_url,browser):
    browser.get(server_url + 'standard/reference/')
    assert '360Giving' in browser.find_element_by_tag_name('body').text


@pytest.mark.parametrize(('text'), [
    ('Recipient Org:County'),
    ('Recipient Org:Country'),
    ('Recipient Org:Description'),
    ('Recipient Org:Web Address'),
    ('Use the three-letter currency code from ISO 4217 eg: GBP')  #Bug #102
    ])
def test_standard_documentation_grants_table(server_url,browser,text):
  browser.get(server_url + 'standard/reference/')
  table = browser.find_element_by_xpath("//*[@id='post-35']/div[1]/table[1]")
  assert text in table.text
    

def test_standard_documentation_pop_out_page(server_url,browser):
    browser.get(server_url + 'wp-content/plugins/threesixty_docs/docson/index.html#/wp-content/plugins/threesixty_docs/standard/schema/360-giving-schema.json$$expand')
    assert 'The currency used in grant amounts and transactions using an ISO 3-letter code. Use GBP for Pounds Sterling.' in browser.find_element_by_xpath('//*[@id="doc"]/div[1]/div[3]/div[5]/div[1]/div[3]/p').text


@pytest.mark.parametrize(('xpath'), [
    ("//*[@id='post-35']/div[1]/p[5]/a"),
    ("//*[@id='post-35']/div[1]/p[43]/a")
    ])
def test_cove_link(server_url, browser, xpath):
  browser.get(server_url + 'standard/reference/')
  href = browser.find_element_by_xpath(xpath)
  href = href.get_attribute("href")
  assert "http://cove.opendataservices.coop/360/" in href


def test_charitycommission_link(server_url,browser):
  browser.get(server_url + 'standard/identifiers/')
  href = browser.find_element_by_xpath("//*[@id='post-7']/div[1]/ol[2]/li[2]/p/a[1]")
  href = href.get_attribute("href")
  assert "http://www.charitycommission.gov.uk/" in href
  

def test_contactus_link(server_url,browser):
  browser.get(server_url + 'standard/identifiers/')
  href = browser.find_element_by_xpath("//*[@id='post-7']/div[1]/ol[2]/li[3]/p/a[2]")
  href = href.get_attribute("href")
  assert "/contact/" in href
  

@pytest.mark.parametrize(('path'), [
    ('standard/reference/'),
    ('standard/identifiers/'),
    ('standard/data-protection/'),
    ('standard/licensing/')
    ])
def test_tocs_exist(server_url,browser,path):
  browser.get(server_url + path)
  browser.find_element_by_id("toc")
  
  
@pytest.mark.parametrize(('logo'), [
    ('heritage-lottery-fund'),
    ('heritage-lottery-fund.jpg'),
    ('arts-council-england.JPG'),
    ('arts-council-northern-ireland.jpg'),
    ('arts-council-wales.jpg'),
    ('department-social-development-northern-ireland.jpg'),
    ('sport-england.jpg'),
    ('wellcome-trust.jpg')
    ])
def test_index_page_logos(server_url,browser,logo):
  browser.get(server_url)
  src = []
  imgs = browser.find_elements_by_tag_name('img')
  for img in imgs:
    src.append(img.get_attribute('src'))
  path = "http://opendataservic.wpengine.com/wp-content/themes/responsive-child/ckan/logos/"
  string = path + logo
  assert string not in src

'''
#On Staging site we have news and blogs separate
def test_news_page(server_url,browser):
  browser.get(server_url + 'category/news')
  assert "Blog Archives" not in browser.find_element_by_tag_name('body').text
  assert "News & Updates" in browser.find_element_by_tag_name('h1').text


def test_redirect(server_url,browser):
  browser.get(server_url + '/news')
  redirect = browser.current_url
  assert "/news/" in redirect
'''
