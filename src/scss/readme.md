# 16x24 folder structure

## Config
`config` is where we setup variables such as colors, viewports, etc.
`_typography.sass` should contain definitions for the fonts being used as
well as the standard baseline and font-size variables. Ideally, no code in
this folder should output CSS, it should be variable definitions, etc.

## Utilities
`utilities` is for snippets of Sass that can be re-used from project to
project. Helper functions for rgba, @extends that can be used for very general
purposes, etc. Ideally, no code in this folder should output actual CSS,
everything should be a mixin definition, a % rule, or a Sass function.

## Reset
`reset` is for ... resets! You'll see there are a couple types of items you
might want to reset setup here, feel free to add new ones. This is where we
keep things like buttons, links, and default typography, as well as links to
@font-face delarations for basic type and icon fonts. Normalize.css is used
as a starting point.

## Modules
‘modules’ is where you actually get things done. Fill it up with a bunch of
files like ‘_header.sass’ and ‘_social-icon-list.sass` or whatever you want
really. Try to stay organized. Make sub-folders if you want! Or don't! Most
of the code which actually generates CSS should be under this directory.
