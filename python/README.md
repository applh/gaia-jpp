# PYTHON CODE 

* WARNING
* CONFIDENTIALITY PROBLEM: 
* .ipynb notebooks contain result outputs
* So they are not suitable for version control
* TODO: clean outputs from notebooks before committing

* create def to declare functions in def-files.iypnb
* then import def-files.ipynb in my-files.ipynb

```ipynb

# load the declarations
%use "def-files.ipynb"

# call your function
my_function(1,2)

```

* to run a notebook from the command line

```
jupyter nbconvert --to notebook --execute my-files.ipynb
```

* to run a notebook from the command line and save the output

```
jupyter nbconvert --to notebook --execute --inplace my-files.ipynb
```

* to run a notebook from the command line and save the output in a new file

```
jupyter nbconvert --to notebook --execute --output my-files-output.ipynb my-files.ipynb
```

## YouTube API


* https://github.com/googleapis/google-api-python-client
* https://developers.google.com/youtube/v3/guides/uploading_a_video?hl=en
* https://developers.google.com/youtube/v3/quickstart/python?hl=en

```shell
pip3 install virtualenv
virtualenv <your-env>
source <your-env>/bin/activate
<your-env>/bin/pip install google-api-python-client

pip install --upgrade google-auth-oauthlib google-auth-httplib2

```

* WARNING: 
* There's a .gitignore file in the virtual env directory (with *)
* So every file is ignored by git 😅


## FRENCH DICT

* https://github.com/chrplr/openlexicon

