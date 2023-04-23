from selenium import webdriver
from selenium.webdriver.common.by import By
from selenium.webdriver.common.keys import Keys
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC
import time

WAIT_TIMEOUT = 10

driver = webdriver.Chrome()

driver.get("http://localhost:5173/login")

wait = WebDriverWait(driver, WAIT_TIMEOUT)
email_field = wait.until(EC.element_to_be_clickable((By.NAME, "email")))
password_field = wait.until(EC.element_to_be_clickable((By.NAME, "password")))

email_field.send_keys("aiviskri@gmail.com")
password_field.send_keys("admin")
email_field.send_keys(Keys.RETURN)

navbar = wait.until(EC.element_to_be_clickable((By.CLASS_NAME, "main-navbar")))

assert "Your decks" in driver.page_source

driver.quit()
