import pytest
from selenium import webdriver
from selenium.webdriver.common.keys import Keys
from selenium.webdriver.common.by import By

@pytest.fixture(scope="module")
def browser(request):
    browser = webdriver.Firefox()
    browser.implicitly_wait(3)
    request.addfinalizer(lambda: browser.quit())
    return browser


@pytest.fixture(scope="module")
def server_url():
    return "http://www.threesixtygiving.org/"
    #return "http://opendataservic.staging.wpengine.com/"
    #return "http://opendataservic.wpengine.com/"


def test_index_page(server_url,browser):
    browser.get(server_url)
    assert "360Giving | The more we know, the better grants we can make" in browser.title
    href = browser.find_element_by_xpath("//*[@id='post-17']/div[1]/div/div[3]/p[1]/a[1]")
    href = href.get_attribute("href")
    assert "http://www.threesixtygiving.org/get-involved/publish-your-data/" in href
    

def test_identifiers_page(server_url,browser):
    browser.get(server_url + 'standard/identifiers/')
    assert '360Giving' in browser.find_element_by_tag_name('body').text
    assert '360 Giving' not in browser.find_element_by_tag_name('body').text


def test_standard_documentation_page(server_url,browser):
    browser.get(server_url + 'standard/reference/')
    assert 'Recipient Org:County' in browser.find_element_by_tag_name('body').text
    assert 'Recipient Org:Country' in browser.find_element_by_tag_name('body').text
    assert 'Recipient Org:Description' in browser.find_element_by_tag_name('body').text
    assert 'Recipient Org:Web Address' in browser.find_element_by_tag_name('body').text

def test_cove_link(server_url,browser):
  browser.get(server_url + 'standard/reference/')
  href = browser.find_element_by_xpath("//*[@id='post-35']/div[1]/p[6]/a")
  href = href.get_attribute("href")
  assert "http://cove.opendataservices.coop/360/" in href
  
  
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
