if (strrpos(get_the_excerpt(), ". ")) {
    echo substr(get_the_excerpt(), 0, strrpos(get_the_excerpt(), ". ") + 1);
} else {
    the_excerpt();
}