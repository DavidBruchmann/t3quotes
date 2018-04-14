TYPO3 Extension ``t3quotes`` 
========================
[![Build Status](https://travis-ci.org/DavidBruchmann/t3quotes.svg?branch=master)](https://travis-ci.org/DavidBruchmann/t3quotes)
[![StyleCI](https://styleci.io/repos/91969362/shield?branch=master)](https://styleci.io/repos/91969362/)

**t3quotes** is an extension for [TYPO3](https://typo3.org) to collect and display quotes.

preface
-------
All versions starting with 2.0.0 are compatibel with TYPO3-7.6, TYPO3-8 and TYPO3-9, the current t3quotes-version has been tested already on all these versions of TYPO3.
The first two versions 0.1.1 and 0.1.2 have been developed and published by the creator of the system TYPO3
**Kasper Skårhøj**, these versions are very old and not running on current versions of TYPO3.  

David Bruchmann is assigned as official maintainer of the extension t3quotes and therefore any issues, propositions and pull requests are at best reported on his [github-page](https://github.com/DavidBruchmann/t3quotes/).

Usage for production servers is possible with version 2.0.1. even not all features and documentation are finished yet.

features
--------
The provided features are almost the same as in the initial concept of Kasper Skårhøj in 2002 while the complete code is absolutely new.  
Two Details are technically new:  
- For the extension are different themes available, between these themes can be easily switched just by TypoScript.  
- The extension includes templates to add new quotes in the frontend. This requires still some binding to users in frontend and/or backend to avoid spamming by anonymous users.

Till the extension can be marked as stable no further features shall be included, but later there are many options like creating images with the quotes for sharing on social media or creating PDF-documents with the quotes.

installation
------------
installation is currently only provided in the conventional way by extension-manager. Releases will be provided on the [releases-page](https://github.com/DavidBruchmann/t3quotes/releases) of the github-repository as well as on the so called "TER", the official [TYPO3-extension-website](https://extensions.typo3.org/extension/t3quotes/).
Documentation will be provided in the folder `Documentation` of the extension and on the [wiki-site](https://github.com/DavidBruchmann/t3quotes/wiki).

Usage is in general similar like any extension on base of extbase and a few profound differences are configured in the provided configuration files.  
These configuration files have to be included in a backend-template and afterwards the constant-editor shows the corresponding options.  
From two existing configurations only one has to be included, it was not tested what happens when both are included.

current state of development
----------------------------
Please have a look on the [issue-pages](https://github.com/DavidBruchmann/t3quotes/issues) or/and the [project-page](https://github.com/DavidBruchmann/t3quotes/projects/1).

Sponsoring
----------
We'd appreciate sponsoring for the development of this extension, please contact David Bruchmann for details.    
Mail: david.bruchmann@gmail.com
