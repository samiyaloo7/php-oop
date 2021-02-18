<?php

    /**
     * instance...
     * - can only have method declaration.
     * - can not contains any properties or method body.
     * - can not be instanciated.
     * - all the method must be override by the class which implements the interface.
     * - if not override all the methods of interface then the class must declared as abstrac.
     * - the purpose of the interface to solve the problem of multiple inheritance not suported.
     * - multiple interface can be implemented in to one class.
     */

    interface ione {
        function func_ione();
        function func_itwo();
    }
    interface itwo {
        function func_ithree();
    }
    class cls1 implements ione, itwo {
        function func_ione() {
            return "\nthis is abstarct methos";
        }
        function func_itwo() {
            return "\nthis is second abstarct methos";
        }
        function func_ithree() {
            return "\nthis is second abstarct methos of second interface";
        }
    }

    abstract class cls2 implements ione {
        function func_ione() {
            return "\n\nthis is abstarct methos";
        }
    }

    $cls = new cls1();
    echo $cls->func_ione();
    echo $cls->func_itwo();
    echo $cls->func_ithree();

    echo cls2::func_ione();
?>