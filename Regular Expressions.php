/***************** REGULAR EXPRESSIONS *****************\

# |   -> OR ex: a|b   -> Searches for eather 'a' or 'b'
# [aeiou] -> matches a single character in the given set
# [^aeiou] -> matches a single character outside the given set
# (foo|bar|baz) -> matches any of the alternatives specified
# . -> Any character
# - -> Range search. Searcher for range ex: a-z .From 'a' to 'z'
# * -> One or more characters, ex: D* - one or more D-s .
# K.* -> All characters comming after the 'K' starting from 'K'
# +  -> Atleast one of the characters, ex: K+
# p? -> It matches any string containing zero or one p's.
# P{3} -> Matches a number of 3 'P'-s
# p{2,3} -> Matches any string containing a sequence of two or three p's.
# p{2,}It matches any string containing a sequence of at least two p's.
# p$ -> It matches any string with p at the end of it.
# ^p -> It matches any string with p at the beginning of it.
# [^a-zA-Z] -> It matches any string not containing any of the characters ranging # from a through z and A through Z.
# [^a-zA-Z] -> It matches any string not containing any of the
# characters ranging # from a through z and A through Z.
# p.p -> It matches any string containing p, followed by any
# character, in turn followed by another p.
# ^.{2}$ -> It matches any string containing exactly two characters
# <b>(.*)</b> -> It matches any string enclosed within <b> and #</b>
# p(hp)* -> It matches any string containing a p followed by zero or more instances of the sequence php.
# [[:alpha:]] -> It matches any string containing alphabetic
# characters aA through zZ.
# [[:digit:]] -> It matches any string containing numerical digits 0 # through 9.
# [[:alnum:]] -> It matches any string containing alphanumeric characters aA through zZ and 0 through 9.
# [[:space:]] -> It matches any string containing a space.
# \s  -> a whitespace character (space, tab, newline)
# \S  -> non-whitespace character
# \d  -> a digit (0-9)
# \D  -> a non-digit
# \w  -> a word character (a-z, A-Z, 0-9, _)
# \W  -> a non-word character
# (?i) -> Case insensitive match
# (?m) -> Multiline matching
# (?s) -> Matches new lines
# (?x) -> White space ignored
# n/a -> Metacharacter match only at the end
# /is/g -> Global search for 'is'
# /i   -> Case sensitive search
# /is/gi -> Global search for 'is' , case insensitive
# /^is/m -> Multiline searching for 'is' at the beginning of each string
# $ -> End
# /^is/gm -> Global multiline search for 'is' at the beginning of each string
# /10?/g  -> Do a global search for a "1", followed by zero or one '0' characters.
# /\d{4}/g -> Global search for a substring that containg a sequence of four digits
# /is(?= all)/g -> Global search for 'is' followed by 'all'
# /is(?! all)/gi -> Global search for 'is' that is NOT followed by 'all'
# /[^h]/g -> Global search for characters thar are not inside the []
# /\bLO/ -> Searches for 'LO' at the beginning of a word in a string
# \B -> NOT at the beginning
# \0 -> Position where the NUL character was found in a string.
# \n -> Searches for a new line character
# \t -> Searches for a tab character
# \A -> Searches for letters a-z or A-Z or numbers 0-9 or _
# w+ -> Searches for 0 or more word characters
# /\A/w+\Z/ -> -> Searches for 0 or more word characters A trhu Z, a thru z, 0 thru 9 or _ .
#  -> #^ and $i  ->  Make the string matches at all the pattern, from start to end for ensure a complete match.
# ([a-z]{1}\:{1})?        The string may starts with one letter and a colon, but only 1 character for eachone, this is for the drive #letter (C:)
#[\\\/]?            The string may contain, but not require 1 slash or backslash after the drive letter, (\/)
# ([\-\w]+[\\\/]?)*    The string must have 1 or more of any character like hyphen, letter, number, underscore, and may contain a # # slash or back slash at the end, to have a directory like ("/" or "folderName" or "folderName/"), this may be repeated one or more # times.