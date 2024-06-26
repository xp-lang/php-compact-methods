<?php namespace lang\ast\syntax\php\unittest;

use lang\IllegalArgumentException;
use lang\ast\Errors;
use lang\ast\unittest\emit\EmittingTest;
use lang\reflection\Annotation;
use test\{Assert, Expect, Test};

class CompactMethodsTest extends EmittingTest {

  #[Test]
  public function with_scalar() {
    $r= $this->run('class %T {
      public fn run() => "test";
    }');
    Assert::equals('test', $r);
  }

  #[Test]
  public function with_property() {
    $r= $this->run('class %T {
      private $id= "test";

      public fn run() => $this->id;
    }');
    Assert::equals('test', $r);
  }

  #[Test]
  public function combined_with_argument_promotion() {
    $r= $this->run('class %T {
      public fn withId(private $id) => $this;
      public fn id() => $this->id;

      public function run() {
        return $this->withId("test")->id();
      }
    }');
    Assert::equals('test', $r);
  }

  #[Test, Expect(IllegalArgumentException::class)]
  public function throw_expression_with_compact_method() {
    $this->run('use lang\IllegalArgumentException; class %T {
      public fn run() => throw new IllegalArgumentException("test");
    }');
  }

  #[Test, Expect(Errors::class)]
  public function cannot_redeclare() {
    $this->declare('class %T {
      public fn run() => "test1";
      public fn run() => "test2";
    }');
  }

  #[Test]
  public function method_annotations() {
    $t= $this->declare('use test\\Test; class %T {
      #[Test] public fn fixture() => "test";
    }');

    Assert::equals(
      new Annotation(Test::class, null),
      $t->method('fixture')->annotation(Test::class)
    );
  }

  #[Test]
  public function param_annotations() {
    $t= $this->declare('use test\\Test; class %T {
      public fn fixture(#[Test] $a) => "test";
    }');

    Assert::equals(
      new Annotation(Test::class, null),
      $t->method('fixture')->parameter(0)->annotation(Test::class)
    );
  }
}