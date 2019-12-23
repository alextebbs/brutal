# EAS Project Base

Base setup for `gulp` and static HTML.

```
git clone git@bitbucket.org:easci/eas-base-2017.git project_name
cd project_name
git remote remove origin
git remote add origin git@bitbucket.org:easci/project_name.git
git push -u origin master

npm install
gulp
```

To enable PHP support, modify buildinfo.json and set the project type to 'PHP'.


See default page and `src/scss/readme.md` for documentation on CSS.
