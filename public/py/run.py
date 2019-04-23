#!/usr/bin/env python
import cv2
# import numpy as np
import pytesseract
import re
import imutils
import requests

font = cv2.FONT_HERSHEY_SIMPLEX
bottomLeftCornerOfText = (150, 150)
fontScale = 1
fontColor = (0, 0, 255)
lineType = 2
tessdata_dir_config = '--tessdata-dir "C:\\Program Files (x86)\\Tesseract-OCR\\tessdata" '

psmmode = 6
image = cv2.imread("d3.png")
image = imutils.resize(image, 500, 500)

# lab= cv2.cvtColor(image, cv2.COLOR_BGR2LAB)
# l, a, b = cv2.split(lab)

height, width, channels = image.shape
height2 = height / 4
width2 = width / 4
print("{} and {} size {}".format(height, width, height * width))
car_cascade = cv2.CascadeClassifier('rus.xml')

# convert to gray scale of each frames
gray = cv2.cvtColor(image, cv2.COLOR_BGR2GRAY)

cars = car_cascade.detectMultiScale(gray, 1.1, 3, minSize=(100, 35), maxSize=(280, 90))
# car_cascade.detectMultiScale(gray,1.4,3,flags=None,minSize=[100,35],maxSize=[280,90])
print(cars)
lpIndex = []

for car in cars:
    (x, y, w, h) = car
    # cv2.rectangle(image,(x,y),(x+w,y+h),(0,255,0),2)
    print(h*w)
    if (x > width2 - 40 and x + w < width - width2) and (y > height / 2 - 10) and 19000 > w * h > 8000:
        lpIndex = car

if len(lpIndex):
    (x, y, w, h) = lpIndex
elif len(cars):
    (x, y, w, h) = cars[0]
else:
    print("LP not detected")

img_plate = gray[y - 7:y + h, x:x + w + 11]
# img_plate = imutils.resize(img_plate, 100, 100)
# kernel = np.ones((2,2),np.uint8)
# gradient = cv2.morphologyEx(img_plate, cv2.MORPH_OPEN, kernel)
# th3 = cv2.adaptiveThreshold(gradient,255,cv2.ADAPTIVE_THRESH_GAUSSIAN_C, cv2.THRESH_BINARY,11,2)
img_plate2 = image[y - 7:y + h, x:x + w + 11]
# hsv = cv2.cvtColor(img_plate2, cv2.COLOR_BGR2HSV)
# low = np.array([0, 0, 163])
# high = np.array([179, 255, 255])
# mask = cv2.inRange(hsv, low, high)
# mask_inv = cv2.bitwise_not(mask)
# fg = cv2.bitwise_and(img_plate2, img_plate2, mask=mask)

#cv2.imshow("dd", img_plate2)
# cv2.imshow("th3", fg)
# text = pytesseract.image_to_string(fg, lang="eng", config=tessdata_dir_config + " --psm " + str(psmmode))
text = pytesseract.image_to_string(img_plate, lang="eng", config=tessdata_dir_config + " --psm " + str(psmmode))
m = re.search("[0-9A-Z]{2}[.]*[\s\S]*[0-9A-Z]{2}[.]*[\s\S]*[0-9A-Z\s]{3}", text)

# print(text)
# if not m:
#     print("not")
#     text = pytesseract.image_to_string(img_plate, lang="eng", config=tessdata_dir_config + " --psm " + str(psmmode))
#     print(text)

# m = re.search("[0-9A-Z]{2}[.]*[\s\S]*[0-9A-Z]{2}[.]*[\s\S]*[0-9A-Z\s]{3}", text)
if m:
    text = m.group(0).replace('\n', ' ')
    cv2.putText(image, text,
                bottomLeftCornerOfText,
                font,
                fontScale,
                fontColor,
                lineType)
    print(text)
    r = requests.get(url='http://lp.com/api/car/' + text)
    responses = r.json()
    if responses:
        cv2.putText(image, "Found",
                    (200, 200),
                    font,
                    fontScale,
                    (0, 255, 0),
                    lineType)
        print(responses)
    else:
        cv2.putText(image, "Not Exists",
                    (200, 200),
                    font,
                    fontScale,
                    fontColor,
                    lineType)
        print("not exist")

# Display frames in a window
#cv2.imshow('plate', img_plate)
#cv2.imshow('video2', image)

# Wait for Esc key to stop
#cv2.waitKey(0)
# De-allocate any associated memory usage
#cv2.destroyAllWindows()
